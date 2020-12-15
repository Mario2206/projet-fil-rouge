<?php 

namespace App\Controller;

use App\Model\PollModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Session;

class PollListController extends Controller {

    private $user;
    private $pollModel;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->protectPageFor("user", "/login");
        $this->pollModel = new PollModel();
    }

    public function pollList () {

        $polls = $this->pollModel->find(["idUser"=>$this->user->idUser]);
        $currentDate = date(TypeConverter::DATE_FORMAT);

        $this->render("pollListView", compact("polls", "currentDate"));
    }

    public function pollListFromFriends() {

        $polls = $this->pollModel->findPollFromFriends($this->user->idUser);
        
        $this->render("pollListFromFriendsView", compact("polls"));
    }

}