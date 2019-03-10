<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    /**
     * @Route("/ingredient", name="ingredient")
     */
    public function index()
    {
        $ingredients = $this->getDoctrine()->getRepository(Ingredient::class);

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients->findAll(),
        ]);
    }

    /**
     * @Route("/ingredient/add", name="add_ingredient")
     */
    public function add(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredient = new Ingredient();

        $form = $this->createForm(IngredientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ingredient->setIngredientName($form['ingredientName']->getData());

            $em->persist($ingredient);
            $em->flush();

            $this->addFlash('notice', 'Your ingredient has been added!');

            return $this->redirectToRoute('ingredient');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
