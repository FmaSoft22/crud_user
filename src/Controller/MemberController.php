<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class MemberController extends AbstractController
{

    private $memberRepository;

    public function __construct(MemberRepository $entityManager)
    {
        $this->memberRepository = $entityManager;
    }

    /**
     * @Route("/welcome",methods={"GET","POST"}, name="app_welcome")
     */
    public function index(): Response
    {
        $allMembers = $this->memberRepository->findAll();
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
            'members'=> $allMembers
        ]);
    }

    /**
     * @Route("/nouvel-utilisateur",methods={"GET","POST"}, name="app_new_member")
     */
    public function addNewMember(Request  $request,ParameterBagInterface  $parameterBag):Response{

        $form = $this->createForm(MemberType::class, (new Member()));
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $member = $form->getData();
            $file = $form->get('file')->getData();
            if(!empty($file)){
                $filename = bin2hex(random_bytes(8)).'.'.$file->guessExtension();
                $file->move( $parameterBag->get('UPLOADS_FOLDER').'/uploads/member/', $filename);
                $member->setPhoto($filename);
            }
            $member->setCreateAt(new \DateTime('now'));
            $member->setUpdateAt(new \DateTime('now'));
            // get Member Data
            $this->memberRepository->save($form->getData(),true);
            $this->addFlash('success','L\'utilisateur à été créé avec succès');
            return $this->redirectToRoute('app_welcome');
        }

        return  $this->render('member/add_new_member.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/lire-utilisateur/{id}",methods={"GET","POST"}, name="app_update_member")
     */
    public function readMember(Request $request,int $id):Response{
        $findMember = $this->memberRepository->findBy([
            'id'=>$id
        ]);
        if(empty($findMember)){
            return $this->createNotFoundException('Member Not Found');
        }
        return $this->render('welcome/read_member.html.twig',[
            'member'=>$findMember
        ]);
    }

    /**
     * @Route("/modifier-utilisateur/{id}",methods={"GET","POST"}, name="app_update_member")
     */
    public function updateMember(Request $request,int $id, ParameterBagInterface $parameterBag):Response{
        $findMember = $this->memberRepository->findOneBy([
            'id'=>$id
        ]);
        if(empty($findMember)){
            return $this->createNotFoundException('Member Not Found');
        }
        $form = $this->createForm(MemberType::class,$findMember,[
            'action'=>$this->generateUrl('app_update_member',['id'=>$id])
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // Proccess
            $member = $form->getData();
            $file = $form->get('file')->getData();
            if(!empty($file)){
                $fileSystem = new Filesystem();
                if(!empty($findMember->getPhoto()) && $fileSystem->exists($parameterBag->get('UPLOADS_FOLDER').'/uploads/member/'.$findMember->getPhoto())){
                    $fileSystem->remove($parameterBag->get('UPLOADS_FOLDER').'/uploads/member/'.$findMember->getPhoto());
                }
                $filename = bin2hex(random_bytes(8)).'.'.$file->guessExtension();
                $file->move( $parameterBag->get('UPLOADS_FOLDER').'/uploads/member/', $filename);
                $member->setPhoto($filename);
            }
            $member->setUpdateAt(new \DateTime('now'));
            // get Member Data
            $this->memberRepository->save($form->getData(),true);

            $this->addFlash('success','L\'utilisateur à été modifié avec succès');
            return $this->redirectToRoute('app_welcome');
        }
        return $this->render('member/update_member.html.twig',[
            'form'=>$form->createView(),
            'member'=>$findMember
        ]);
    }

    /**
     * @Route("/supprimer-utilisateur/{id}",methods={"GET","POST"}, name="app_delete_member")
     */
    public function deleteMember(Request $request,int $id):Response{
        $findMember = $this->memberRepository->findOneBy([
            'id'=>$id
        ]);
        if(empty($findMember)){
            return $this->createNotFoundException('Member Not Found');
        }
        $this->memberRepository->remove($findMember,true);
        $this->addFlash('success','L\'utilisateur à été supprimé avec succès');
        return $this->redirectToRoute('app_welcome');
    }
}
