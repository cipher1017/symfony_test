<?php

namespace App\Command;

use App\Entity\Blogs;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'RssFetchCommand',
    description: 'rss fetch commands',
)]
class RssFetchCommand extends Command
{
    public function __construct(
        protected readonly CategoryRepository $categoryRepository,
        protected readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $categories = $this->categoryRepository->findAll();
        foreach ($categories as $category){
            $feedUrl = $category->getFeedUrl();
            $rss =  simplexml_load_file($feedUrl);
            $posts = array();
            foreach ($rss->channel->item as $item){
                if(!$category->getFeedLastUpdatedAt()){
                    $posts[] = $item;
                } else{
                    if(
                        $category->getFeedLastUpdatedAt()->getTimestamp() <
                        (new \DateTime($item->pubDate))->getTimestamp()) {
                        $posts [] = $item;
                    }
                }
                //save to the database
                foreach ($posts as $post){
                    $blog = (new Blogs())
                        ->setTitle($post->title)
                        ->setDescription($post->description)
                        ->setCategory($category)
                        ->setCreatedAt(new \DateTime($post->pubDate));

                    $this->entityManager->persist($blog);
                }
                $this->entityManager->flush();
            }
    }
        return Command::SUCCESS;
    }
}
