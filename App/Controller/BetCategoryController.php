<?php

namespace App\Controller;

use App\Model\CategoryModel;
use Core\Controller\Controller;

class BetCategoryController extends Controller {

    private $categoryModel;
    private $user;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
         $this->user = $this->protectPageFor("user", LOGIN);
    }


    /**
     * For displaying all available categories
     */
    public function showCategories() {
        $categories = $this->categoryModel->getAllCategories();
        $this->render("betCategoriesView", compact("categories"));
    }

    /**
     * For showing only categories which contain some bets created by the current user 
     */
    public function showPrivateCategories() {
        $categories = $this->categoryModel->getOnlyPrivateCategories($this->user->idUser);
        $this->render("ownBetCategoriesView", compact("categories"));
    }

}