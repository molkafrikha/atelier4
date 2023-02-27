<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    #[Route('/classroom/list', name: 'classroom_list')]
    public function list(): Response
    {
        $classrooms = $this->getDoctrine()->getRepository(Classroom::class)->findAll();

        return $this->render('classroom/list.html.twig', [
            'classrooms' => $classrooms,
        ]);
    }
    #[Route('/classroom/new', name: 'classroom_new')]
    public function new(Request $request): Response
    {
        $classroom = new Classroom();

        $form = $this->createFormBuilder($classroom)
            ->add('name')
            
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classroom = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classroom);
            $entityManager->flush();

            return $this->redirectToRoute('classroom_list');
        }

        return $this->render('classroom/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/classroom/{id}/edit', name: 'classroom_edit')]
    public function edit(Request $request, Classroom $classroom): Response
    {
        $form = $this->createFormBuilder($classroom)
            ->add('name')
            
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classroom = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classroom);
            $entityManager->flush();

            return $this->redirectToRoute('classroom_list');
        }

        return $this->render('classroom/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/classroom/{id}/delete', name: 'classroom_delete')]
public function delete(Request $request, Classroom $classroom): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($classroom);
    $entityManager->flush();

    return $this->redirectToRoute('classroom_list');
}
}
