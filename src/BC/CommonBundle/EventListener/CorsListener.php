<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 01/08/2017
 * Time: 19:00
 */

namespace BC\CommonBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class CorsListener {

    /**
     *
     * check if we have a options CORS request - dont process anything in this case ! - just say its OK
     *
     *
     *  also check https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS#Preflighted_requests
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event) {

        $request = $event->getRequest();
        if ($request->headers->has("Access-Control-Request-Headers")
            && $request->headers->has("Access-Control-Request-Method")) {

            $response = new Response();
            //enable CORS - return the requested methods as allowed
            $response->headers->add(
                array('Access-Control-Allow-Headers' => $request->headers->get("X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"),
                    'Access-Control-Allow-Methods' => $request->headers->get("GET, POST, OPTIONS, PUT, DELETE"),
                    'Access-Control-Allow-Origin' => '*'));
            $event->setResponse($response);
            $event->stopPropagation();
        }
    }

    /**
     *
     * add CORS crossdomain for all requests accepting JSON
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event) {
        $response = $event->getResponse();
        $request = $event->getRequest();
        if ($request->headers->has("Accept") &&
            strstr($request->headers->get("Accept"), "application/json")) {
            $response->headers->add(array('Access-Control-Allow-Origin' => '*'));
        }
    }
}