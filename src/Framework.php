<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Monitoring\TransactionMonitoring;
use Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UnauthorizedException;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use Kartenmacherei\RestFramework\Router\RouterChain;

class Framework
{
    /**
     * @var RouterChain
     */
    private $routerChain;
    /**
     * @var ActionMapper
     */
    private $actionMapper;

    /**
     * @var TransactionMonitoring
     */
    private $transactionMonitoring;

    /**
     * @var TransactionNameMapper
     */
    private $transactionNameMapper;

    /**
     * @param RouterChain $routerChain
     * @param ActionMapper $actionMapper
     * @param TransactionMonitoring $transactionMonitoring
     * @param TransactionNameMapper $transactionNameMapper
     */
    public function __construct(
        RouterChain $routerChain,
        ActionMapper $actionMapper,
        TransactionMonitoring $transactionMonitoring,
        TransactionNameMapper $transactionNameMapper
    ) {
        $this->routerChain = $routerChain;
        $this->actionMapper = $actionMapper;
        $this->transactionMonitoring = $transactionMonitoring;
        $this->transactionNameMapper = $transactionNameMapper;
    }

    /**
     * @param Config $config
     * @return Framework
     */
    public static function createInstance(Config $config): Framework
    {
        $factory = new Factory($config);

        return new self(
            $factory->createRouterChain(),
            $factory->createActionMapper(),
            $factory->createTransactionMonitoring(),
            $factory->createTransactionNameMapper()
        );
    }

    /**
     * @param ResourceRouter $router
     */
    public function registerResourceRouter(ResourceRouter $router)
    {
        $this->routerChain->addRouter($router);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws UnsupportedRequestMethodException
     */
    public function run(Request $request): Response
    {
        try {
            $resource = $this->routerChain->route($request);
            if ($request->isOptionsRequest()) {
                return new OptionsResponse($resource->getSupportedMethods());
            }

            $action = $this->actionMapper->getAction($request, $resource);
            $this->setTransactionName($action);

            return $action->execute();
        } catch (NoMoreRoutersException $e) {
            return new NotFoundResponse();
        } catch (UnauthorizedException $e) {
            return new UnauthorizedResponse();
        } catch (BadRequestException $e) {
            return new BadRequestResponse($e);
        }
    }

    private function setTransactionName(Action $action)
    {
        $transactionName = $this->transactionNameMapper->getTransactionName(get_class($action));
        $this->transactionMonitoring->nameTransaction($transactionName);
    }
}
