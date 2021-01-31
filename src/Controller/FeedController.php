<?php

namespace App\Controller;
use App\Entity\Feed;
use App\Form\FeedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
 

class FeedController extends AbstractController
{
    /**
     * @Route("/feed", name="feed_index")
     */
    public function index(): Response
    {
    		//$feed = new Feed();
    	  
          $feed = $this->getDoctrine()
            ->getRepository(Feed::class)
            ->findAll();

        return $this->render('feed/index.html.twig', [
            'feed' => $feed,
        ]);
    }

/**
     * @Route("/feed/add", name="feed_add")
     */
    public function add(Request $request) {
    	$feed = new Feed();

        $form = $this->createForm(FeedType::class, $feed);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $feed->setVendor($feed->getVendor());
            // Set url
            $feed->setUrl($feed->getUrl());

            $feed->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));

            $feed->setStatus(TRUE);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($feed);
            $em->flush();

            return $this->redirectToRoute('feed_index');
        }

        return $this->render('feed/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


/**
     * @Route("/feed/edit/{id}", name="feed_edit")
     */
    public function edit(Request $request) {
    	
    	 $feed = $this->getDoctrine()
            ->getRepository(Feed::class)
            ->find($request->get('id'));

        $form = $this->createForm(FeedType::class, $feed);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $feed->setVendor($feed->getVendor());
            // Set url
            $feed->setUrl($feed->getUrl());

            $feed->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));

            $feed->setStatus(TRUE);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($feed);
            $em->flush();

            return $this->redirectToRoute('feed_index');
        }

        return $this->render('feed/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/feed/delete", name="feed_delete")
     */
    public function delete(Request $request) {
    	//fetching singlr feed
    	$feed = $this->getDoctrine()->getRepository(Feed::class)->find($request->get('id'));
      
        $em =  $this->getDoctrine()->getManager();
 		//deleting feed
 		$em->remove($feed);
    	$em->flush();

        return $this->redirectToRoute('feed_index');

    }


}
