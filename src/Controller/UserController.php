<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\NewPasswordType;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, LoginFormAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler): Response
    {
        //We instantiate a user object
        $user = new User();
        //Create form for a new user
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //When the form is submitted we encrypt his password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            //We save the new user in the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //We are redirected to the name of route
            return $this->redirectToRoute('user_index');
        }
        //We create a view to display the form
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/password", name="user_password", methods={"GET","POST"})
    */
    public function resetPassword(Request $request, \Swift_Mailer $mailer, UserRepository $userRepository, UserPasswordEncoderInterface $encoder): Response
    {
        //Create form for reset password
        $form = $this->createForm(NewPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //When the form is submitted we get the email
            $data = $form->getData();
            $mail = $data['email'];
            //Use of a method of doctrine to verify the email of the database and that to get in the form
            $repository = $this->getDoctrine()->getRepository(User::class);
            if ($user = $repository->findOneBy([ 'email' => $mail ])) {
                //Change the current password with a new password 
                $plainPassword = 'test';     
                //We crypt him
                $encoded = $encoder->encodePassword($user, $plainPassword);       
                $user->setPassword($encoded);
                //We save the new password in the database
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                //We send the new password encrypt to the email that was get in the form
                $message = (new \Swift_Message("Demande de nouveau mot de passe"))
                ->setFrom('')
                ->setTo("$mail")
                ->setBody("Voici votre nouveau mot de passe : $plainPassword"); 
                $mailer->send($message);
            }
            //If not we will show him an error message
            else {
                echo("L'email rentrée n'est pas reconnu");
            }   
        }   
        //We create a view to display the form
        return $this->render('user/email.html.twig', [

            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        //We get a single user we display his informations about him
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder, LoginFormAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler): Response
    {
        //Create form for edit user
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        //When the form is submitted we encrypt his password
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            //We save the new informations user in the database
            $this->getDoctrine()->getManager()->flush();

            //We are redirected to the name of route
            return $this->redirectToRoute('user_index', [
                'id' => $user->getId(),
            ]);
        }
        //We create a view to display the form
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        //We delete a single user
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        //We are redirected to the name of route
        return $this->redirectToRoute('user_index');
    }
   
}