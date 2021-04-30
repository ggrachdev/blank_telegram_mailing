<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\MailingDataRepository;

class TelegramMailingCommand extends Command {

    // php bin/console app:telegram:mailing
    protected static $defaultName = 'app:telegram:mailing';
    protected $mailingDataRepository;

    public function __construct(MailingDataRepository $repository) {
        $this->mailingDataRepository = $repository;

        parent::__construct();
    }

    protected function configure() {
        $this->setDescription('Рассылка сообщений в канал');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);

        $mail = $this->mailingDataRepository->getRandomElement();

        if (!empty($mail) && !empty($mail->getMessage())) {
            $telegramManager = new \App\SocialNetwork\TelegramManager\TelegramManager($_SERVER['TELEGRAM_TOKEN'], $_SERVER['TELEGRAM_CHANNEL_NAME']);
            $res = $telegramManager->post($mail->getMessage());

            if ($res) {
                $io->success("Рассылка успешно выполнена");
            }
            else
            {
                $io->error("Не удалось отправить сообщение");
            }
        } else {
            $io->error("Не удалось найти сообщение для рассылки");
        }


        return 0;
    }

}
