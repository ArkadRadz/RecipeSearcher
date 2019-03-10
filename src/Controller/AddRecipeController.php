<?php

namespace App\Controller;

use App\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddRecipeController extends AbstractController
{
    /**
     * @Route("/recipes", name="show_recipes")
     */
    public function index()
    {
        return $this->render('add_recipe/index.html.twig', [
            'controller_name' => 'AddRecipeController',
        ]);
    }

    /**
     * @Route("/recipes/add", name="add_recipe")
     */
    public function new()
    {
        $form = $this->createForm(RecipeType::class);

        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
