<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Users;

class UserController extends AbstractController
{
    /**
     * @Route("/user/list", name="list_user", methods={"GET"})
     */
    public function list()
    {

        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();
    
        return new JsonResponse($users, Response::HTTP_OK);
    }

    /**
     * @Route("/user/add", name="add_user", methods={"POST"})
     */
    public function add(Request $request,ValidatorInterface $validator): JsonResponse
    {
        $name = $request->get('name');
        $surname = $request->get('surname');

        if (empty($name) || empty($surname)) {
            return new JsonResponse(['status' => 'Error','message'=>"Podano nieprawidłowe dane"], Response::HTTP_NO_CONTENT);
        }
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setName($name);
        $user->setSurname($surname);

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            return new JsonResponse(['status' => 'Error', 'message' => "Dane nie są unikatowe"], Response::HTTP_NO_CONTENT);
        }

        $entityManager->persist($user);
        $entityManager->flush();



        return new JsonResponse(['status' => 'Success'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/user/edit", name="PUT")
     */
    public function edit(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $surname = $request->get('surname');

        if (empty($id) || empty($name) || empty($surname)) {
            return new JsonResponse(['status' => 'Error','message'=>"Podano nieprawidłowe dane"], Response::HTTP_NO_CONTENT);
        }
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $id]);

        if(empty($user)){
            return new JsonResponse(['status' => 'Error','message' => 'Nie znaleziono użytkownika'], Response::HTTP_NOT_FOUND);
        }

        $user->setName($name);
        $user->setSurname($surname);

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            return new JsonResponse(['status' => 'Error', 'message' => "Dane nie są unikatowe"], Response::HTTP_NO_CONTENT);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Success'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/user/delete/id/{id}", name="delete_user", name="DELETE")
     */
    public function delete($id): JsonResponse
    {
        if(empty($id)){
            return new JsonResponse(['status' => 'Error','message' => 'Nie podano ID'], Response::HTTP_NO_CONTENT);
        }

        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $id]);

        if(empty($user)){
            return new JsonResponse(['status' => 'Error','message' => 'Nie znaleziono użytkownika'], Response::HTTP_NOT_FOUND);
        }
        

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Success','message' => 'Użytkownik usunięty'], Response::HTTP_OK);
    }
}
