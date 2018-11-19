<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 18/11/2018
 * Time: 19:58
 */

namespace AV\FrontendBundle\Controller;

use AV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontendController extends Controller {

    public function eventsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Entity::CATEGORIA)->find($this->getParameter('av.cat.eventos'));
        $events = $em->getRepository(Entity::EVENTO)->findBy(['activo' => true, 'categoria' => $cat]);

        if (count($events) > 6) {
            shuffle($events);
            $events = array_slice($events, 0, 6);
        }

        return $this->render('FrontendBundle:Frontend:events.html.twig', [
            'events' => $events,
        ]);
    }

    public function eventDetailsRefAction(Request $request, $ref) {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Entity::EVENTO)->findOneBy(['ref' => $ref]);

        if (empty($event)) {
            return $this->redirectToRoute('frontend_homepage', ['_locale' => $request->getLocale()]);
        }

        return $this->render('FrontendBundle:Frontend:event-details-ref.html.twig', [
            'event' => $event
        ]);
    }

}