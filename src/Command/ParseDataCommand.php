<?php

namespace App\Command;

//use App\Repository\CommentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Parser\DataParsingSerializer;

class ParseDataCommand extends Command {

//    private $commentRepository;
    // php bin/console app:parse:data
    protected static $defaultName = 'app:parse:data';

    public function __construct(/* CommentRepository $commentRepository */) {
//        $this->commentRepository = $commentRepository;

        parent::__construct();
    }

    protected function configure() {
        $this->setDescription('Парсинг данных');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);

        $parser = new \App\Parser\Parser();
        $resultParsing = $parser->parse();

        $result = DataParsingSerializer::toFile($resultParsing, __DIR__ . '/../../var/parsing/data.txt');

        if ($result) {
            $io->success("Парсинг успешно выполнен");
        } else {
            $io->error("Парсинг не выполнен");
        }

        return 0;
    }

}
