<?php 

namespace App\Controller;

use App\Model\BetModel;
use App\Model\CategoryModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Session;

class BetListController extends Controller {

    private $user;
    private $betModel;
    private $categoryModel;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->protectPageFor("user", "/login");
        $this->betModel = new BetModel();
        $this->categoryModel = new CategoryModel();
    }

    /**
     * (GET) For getting the bets created by the current user from a specific category
     * 
     * @param string $categoryCode
     */
    public function ownBetListFromCategory (string $categoryCode) {
        $bets = $this->betModel->findBetsFromCategory( $categoryCode, $this->user->idUser, false );

        $currentDate = date(TypeConverter::DATE_FORMAT);

        $this->render("ownBetListView", compact("bets", "currentDate"));
    }

    /**
     * (GET) For getting all available bet from a specific category
     * 
     * @param string $categoryCode
     */
    public function globalBetListFromCategory(string $categoryCode) {

        $category = $this->categoryModel->findByCode($categoryCode);

        if(!$category) {
            $this->redirectWithErrors(BET_LIST, "La catégorie souhaitée n'existe pas");
        }

        $bets = $this->betModel->findBetsFromCategory($categoryCode , $this->user->idUser);
        
        $this->render("betListView", compact("bets", "category"));
    }

}