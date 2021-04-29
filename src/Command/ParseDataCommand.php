<?php
namespace App\Command;

//use App\Repository\CommentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ParseDataCommand extends Command
{
//    private $commentRepository;

    // php bin/console app:telegram:mailing
    protected static $defaultName = 'app:parse:data';

    public function __construct(/*CommentRepository $commentRepository*/)
    {
//        $this->commentRepository = $commentRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Парсинг данных');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);


        $io->success("Парсинг успешно выполнен");

        return 0;
    }
}