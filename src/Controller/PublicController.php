<?php


namespace App\Controller;


use App\Entity\Announcement;
use App\Entity\Domain;
use App\Entity\User;
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
    public function dashboard(EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();

        $repository = $entityManager->getRepository(Announcement::class);
        $announcements = $repository->findAll();

        $repository2 = $entityManager->getRepository(Domain::class);
        $domain = $repository2->find(2);

        if($user->getArePreferencesEmpty() == false) {
            foreach ($announcements as $announcement) {
                if($announcement->getDomain() == $domain->getTitle()) {
                    return $this->render('public/board.html.twig', [
                        'user' => $user,
                        'preferences_empty' => $user->getArePreferencesEmpty(),
                        'announcements' => $announcements,
                        'domain' => $domain->getTitle()
                    ]);
                }
            }
        }

        return $this->render('public/board.html.twig', [
            'user' => $user,
            'preferences_empty' => $user->getArePreferencesEmpty(),
            'announcements' => $announcements,
            'domain' => "null"
        ]);
    }

    /**
     * @Route("/preferences", name="preferences")
     */
    public function preferences(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(SuggestionCompanyType::class);

        $form->handleRequest($request);

        $user = $this->getUser();

        if($form->isSubmitted() && $form->isValid()) {
            $values = $form->getData();
            $values->setUser($user);
            $user->setArePreferencesEmpty(false);
            $entityManager->persist($values);
            $entityManager->flush();

            return $this->redirectToRoute("dashboard");
        }

        return $this->render('public/suggestion-form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ajouter-annonce/{id<\d+>}", name="add_announcement")
     */
    public function addAnnouncement(EntityManagerInterface $entityManager, $id)
    {
        $user = $this->getUser();

        $repository = $entityManager->getRepository(Announcement::class);
        $announceToAdd = $repository->find($id);
        $announceToAdd->setUser($user);
        $entityManager->flush();

        $repository = $entityManager->getRepository(Announcement::class);
        $announcements = $repository->findAll();

        return $this->render('public/board.html.twig', [
            'user' => $user,
            'preferences_empty' => $user->getArePreferencesEmpty(),
            'announcements' => $announcements,
            'domain' => 'null'
        ]);
    }
}