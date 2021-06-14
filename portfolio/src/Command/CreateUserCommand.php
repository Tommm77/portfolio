<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';
    protected function configure(): void
    {
        // ...
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $secret = 'deded';
        $gRecaptchaResponse = null;
        $remoteIp = null;
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->setExpectedHostname('recaptcha-demo.appspot.com')
            ->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {
            // Verified!
        } else {
            $errors = $resp->getErrorCodes();
        }
        return  1;
    }
}
