<?php
/**
 * Simple Slack API for RomanianIT.
 *
 * @package    RomanianIT
 * @subpackage Services
 * @author     Bogdan SOOS <bogdan.soos@dynweb.org>
 * @version    1.0
 * ...
 */
namespace WebsiteBundle\Services;

use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\Container;
use WebsiteBundle\Entity\Member;

/**
 * Class Slack.
 *
 * @package WebsiteBundle\Services
 */
class Slack
{

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string - slack token
     */
    protected $token;

    /**
     * @var string - general channel id
     */
    protected $channel;

    /**
     * Slack constructor.
     *
     * @param $container
     * @param $token
     * @param $channel
     */
    public function __construct($container, $token, $channel)
    {
        $this->container = $container;
        $this->token = $token;
        $this->channel = $channel;
    }


    /**
     * Invite a new user to our slack community.
     *
     * @param Member $member
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function inviteUser($member)
    {
        /** @var Client $client */
        $client = $this->container->get('guzzle.client.slack_api');
        $response = $client->get('/users.admin.invite', [
            'query' => $this->__getParameters([
                'email' => $member->getEmail()
            ])
        ]);

        return $response;
    }


    /**
     * Create parameters array.
     *
     * @param array $parameters
     * @return array
     */
    private function __getParameters(array $parameters)
    {
        $config = array_merge([
            'token' => $this->token,
            'channels' => $this->channel
        ], $parameters);

        return $config;
    }
}