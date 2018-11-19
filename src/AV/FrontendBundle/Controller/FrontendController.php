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

    public function ministerioAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $faqs = $em->getRepository(Entity::FAQ)->findBy(['activo' => true]);
        return $this->render('FrontendBundle:Frontend:ministerio.html.twig', [
            'faqs' => $faqs
        ]);
    }

    public function eventsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository(Entity::CATEGORIA)->find($this->getParameter('av.cat.eventos'));
        $events = $em->getRepository(Entity::EVENTO)->findBy(['activo' => true, 'categoria' => $cat]);

        return $this->render('FrontendBundle:Frontend:events.html.twig', [
            'events' => $events,
            'textHeader' => $this->get('translator')->trans('f.eventos')
        ]);
    }

    public function adoracionesAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository(Entity::CATEGORIA)->find($this->getParameter('av.cat.adoracion.alabanzas'));
        $events = $em->getRepository(Entity::EVENTO)->findBy(['activo' => true, 'categoria' => $cat]);

        return $this->render('FrontendBundle:Frontend:events.html.twig', [
            'events' => $events,
            'textHeader' => $this->get('translator')->trans('nav.adoracion.y.alabanzas')
        ]);
    }

    public function momentosAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository(Entity::CATEGORIA)->find($this->getParameter('av.cat.momentos.sobrenaturales'));
        $events = $em->getRepository(Entity::EVENTO)->findBy(['activo' => true, 'categoria' => $cat]);

        return $this->render('FrontendBundle:Frontend:events.html.twig', [
            'events' => $events,
            'textHeader' => $this->get('translator')->trans('nav.momentos.supernaturales.y.testimonios')
        ]);
    }

    public function ensenanzasAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository(Entity::CATEGORIA)->find($this->getParameter('av.cat.ensenanzas'));
        $events = $em->getRepository(Entity::EVENTO)->findBy(['activo' => true, 'categoria' => $cat]);

        return $this->render('FrontendBundle:Frontend:events.html.twig', [
            'events' => $events,
            'textHeader' => $this->get('translator')->trans('nav.ensenanzas')
        ]);
    }

    public function trabajoComunitacioAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository(Entity::CATEGORIA)->find($this->getParameter('av.cat.trabajo.comunitario'));
        $events = $em->getRepository(Entity::EVENTO)->findBy(['activo' => true, 'categoria' => $cat]);

        return $this->render('FrontendBundle:Frontend:events.html.twig', [
            'events' => $events,
            'textHeader' => $this->get('translator')->trans('nav.trabajo.comunitario')
        ]);
    }

}