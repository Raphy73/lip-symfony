<?php


namespace App\Controller;


use App\Form\SigninCompanyType;
use App\Form\SigninSchoolType;
use App\Form\SuggestionCompanyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('public/home.html.twig', [

        ]);
    }

    /**
     * @Route("/ecole/inscription", name="school_signin")
     */
    public function schoolSignin(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(SigninSchoolType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $values = $form->getData();
            $values->setRoles(["ROLE_SCHOOL"]);
            $values->setArePreferencesEmpty(true);
            $entityManager->persist($values);
            $entityManager->flush();

            return $this->redirectToRoute("app_login");
        }

        return $this->render('public/signin-school.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/entreprise/inscription", name="company_signin")
     */
    public function companySignin(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(SigninCompanyType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $values = $form->getData();
            $values->setRoles(["ROLE_COMPANY"]);
            $values->setArePreferencesEmpty(true);
            $entityManager->persist($values);
            $entityManager->flush();

            return $this->redirectToRoute("app_login");
        }

        return $this->render('public/signin-company.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $user = $this->getUser();

        return $this->render('public/board.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/preferences", name="preferences")
     */
    public function preferences(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(SuggestionCompanyType::class);

        $form->handleRequest($request);

        return $this->render('public/suggestion-form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}