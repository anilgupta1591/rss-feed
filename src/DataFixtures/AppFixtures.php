<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Content;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    	for ($i=0; $i < 10; $i++) { 
    		$content = new Content();
	        $content
	            ->setTitle('This is dummy post:'.$i)
	            ->setLink('https://www.axelerant.com/resources/articles/'.$i)
	            ->setDescription('Lorem Ipsum is simply placeholder text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard placeholder text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
	            ->setPubDate(new \DateTime(date('Y-m-d H:i:s')))
	            ->setVendor('Axelerant')
	            ->setGuid($i)
	            ->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')))
	            ->setStatus(1);
	        $manager->persist($content);
    		
    	}	

        $manager->flush();
    }
}


