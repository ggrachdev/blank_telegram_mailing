<?php
namespace App\Command;

//use App\Repository\CommentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TelegramMailingCommand extends Command
{
//    private $commentRepository;

    // php bin/console app:telegram:mailing
    protected static $defaultName = 'app:telegram:mailing';

    public function __construct(/*CommentRepository $commentRepository*/)
    {
//        $this->commentRepository = $commentRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Рассылка сообщений в канал');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);


        $io->success("Рассылка успешно выполнена");

        return 0;
    }
}