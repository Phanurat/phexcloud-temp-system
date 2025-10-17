<?php
namespace OCA\TempApp\Controller;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\IRequest;

class TempUserController extends Controller {
    public function __construct($appName, IRequest $request) {
        parent::__construct($appName, $request);
    }

    public function createTempUser($quota = "5GB") {
        $username = "tempuser_" . uniqid();
        $password = bin2hex(random_bytes(8));

        // เรียก occ CLI ผ่าน exec
        exec("docker exec -u www-data nextcloud-app php occ user:add $username --password $password");
        exec("docker exec -u www-data nextcloud-app php occ user:setting $username files quota $quota");

        // บันทึก metadata
        $expire = date('Y-m-d H:i:s', strtotime('+1 day'));
        file_put_contents("/var/www/html/data/tempusers.csv", "$username,$expire\n", FILE_APPEND);

        return new DataResponse(['username'=>$username,'password'=>$password,'expire'=>$expire]);
    }

    public function uploadTempFile($username, $expire_minutes = 60) {
        if(!isset($_FILES['file'])) return new DataResponse(['error'=>'No file uploaded'], 400);

        $file = $_FILES['file'];
        $dest = "/var/www/html/data/$username/".$file['name'];
        move_uploaded_file($file['tmp_name'], $dest);

        // Save expire timestamp
        $expire_ts = strtotime("+$expire_minutes minutes");
        file_put_contents("/var/www/html/data/tempfiles.csv", "$username,$dest,$expire_ts\n", FILE_APPEND);

        return new DataResponse(['status'=>'ok','file'=>$file['name'],'expire'=>$expire_ts]);
    }
}
