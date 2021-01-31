<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\DBAL\Connection;
use App\Entity\Content;

class CreateContentCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'create:feedContent';

    protected function configure()
    {
        $this
            //->setName('create:feedContent')
            ->setDescription('Add a content in feed')
            ->addArgument('title', InputArgument::OPTIONAL, 'Content title')
            ->addArgument('link', InputArgument::OPTIONAL, 'Content link')
            ->addArgument('description', InputArgument::OPTIONAL, 'Content description')
            ->addArgument('vendor', InputArgument::OPTIONAL, 'Content vendor')
            ->addArgument('guid', InputArgument::OPTIONAL, 'Content unique id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
         $this->doctrine = $this->getContainer()->get('doctrine');
        $em = $this->doctrine->getManager();

        $title = $input->getArgument('title');
        $link = $input->getArgument('link');
        $description = $input->getArgument('description');
        $vendor = $input->getArgument('vendor');
        $guid = $input->getArgument('guid');

       
            $content = new Content();
            $content
                ->setTitle($title)
                ->setLink($link)
                ->setDescription($description)
                ->setPubDate(new \DateTime(date('Y-m-d H:i:s')))
                ->setVendor($vendor)
                ->setGuid($guid)
                ->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')))
                ->setStatus(1);
            $em->persist($content);
            
        

        $em->flush();


        $io->success('Feed content created');

        return 0;
    }
}
