<?php

namespace AV\FrontendBundle\Controller;

use AV\CommonBundle\Entity\Newsletter;
use AV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $faqs = $em->getRepository(Entity::FAQ)->findBy(['activo' => true]);

        return $this->render('FrontendBundle:Default:index.html.twig', [
            'isIndex' => true,
            'faqs' => $faqs,
        ]);
    }

    public function eventDetailsAction(Request $request) {
        return $this->render('FrontendBundle:Default:event-details.html.twig', [

        ]);
    }

    public function subscribeAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            $email = $request->get('news_email');
            $exist = $em->getRepository(Entity::NEWSLETTER)->findOneBy(['email' => $email]);

            if (empty($exist)) {
                $news = new Newsletter();
                $news->setEmail($email);

                $em->persist($news);
                $em->flush();
            }
        }

        return $this->redirectToRoute('frontend_homepage', ['_locale' => $request->getLocale()]);
    }
}
