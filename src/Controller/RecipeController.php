<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\Step;
use App\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipes", name="show_recipes")
     */
    public function index()
    {
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }

    /**
     * @Route("/recipes/add", name="add_recipe")
     */
    public function new(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $recipe = new Recipe();

        $form = $this->createForm(RecipeType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setName($form['name']);
            $recipe->setEstimatedTimeToMake($form['estimated_time_to_make']);
            $recipe->setEstimatedDifficulty($form['estimated_difficulty']);
            $recipe->setIngredients($form['ingredients']);
            $recipe->setStepsToMake($form['steps_to_make']);

            $em->persist($recipe);
            $em->flush();

            $this->addFlash('notice', 'Your ingredient has been added!');

            return $this->redirectToRoute('ingredient');
        }

        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
