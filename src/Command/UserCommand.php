<?php

namespace App\Command;

use App\Entity\Blogs;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'rss-reader',
    description: 'Add a short description for your command',
)]
class UserCommand extends Command
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

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //assuming you have a list of blog categories stored in the db
        //fetch all the categories where category.feed_url is not null


        return Command::SUCCESS;
    }
}
