<?php 

namespace App\Controller;

use App\Model\UserModel;
use App\Model\UserPaymentModel;
use Core\Controller\Controller;
use Core\Tools\Session;
use Exception;

class PointsController extends Controller {

    private $user;
    private $userModel;
    private $userPaymentModel;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->userModel = new UserModel();
        $this->userPaymentModel = new UserPaymentModel();
    }
    
    /**
     * (POST) When an user pays some points for playing to a bet
     * 
     * @param string $betId
     */
    public function userPayment(string $betId) {

        if(!isset($_POST["user_points"]) || !is_numeric($_POST["user_points"])) {
            throw new Exception("The user payment request is incorrect", HTTP_BAD_REQ);
        }

        $payment = $_POST["user_points"];
        $currentPoints = $this->user->points;

        if($currentPoints < $payment || !$payment ) {
            $this->redirectWithErrors(BET_RESPONSE_START . "/" . $betId, "Vous n'avez pas assez de points pour jouer cette somme");
        }

        
        $this->userModel->updateUserPoints($currentPoints - $payment, $this->user->idUser);

        $this->userPaymentModel->save($this->user->idUser, $betId, $payment);

        $updatedUser = $this->userModel->findOne(["idUser" => $this->user->idUser]);

        Session::set("user", $updatedUser);

        $this->redirect(BET_RESPONSE . "/" . $betId);

    }

}