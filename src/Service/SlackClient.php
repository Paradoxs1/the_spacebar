<?php
/**
 * Created by PhpStorm.
 * User: Paradoxs
 * Date: 10.08.2018
 * Time: 17:44
 */

namespace App\Service;


use Nexy\Slack\Client;
use App\Helper\LoggerTrait;

class SlackClient
{
    use LoggerTrait;

    /**
     * @var Client
     */
    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Beaming a message to Slack!', [
            'message' => $message
        ]);

        $message = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);

        $this->slack->sendMessage($message);
    }
}