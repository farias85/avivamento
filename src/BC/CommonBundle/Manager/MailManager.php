<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace BC\CommonBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of MailManager
 *
 * @author Logistica
 */
class MailManager {

    protected $mailer;
    protected $twig;
    protected $container;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, ContainerInterface $container) {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->container = $container;
    }

    /**
     * Send email
     *
     * @param   string $emailTemplate email template
     * @param   mixed $parameters custom params for template
     * @param   string $to to email address or array of email addresses
     * @param   string $from from email address
     * @param   string $locale
     * @param   string $fromName from name
     * @param   string $cc cc copy
     * @param   string $bcc bcc hide copy
     *
     * @return  boolean                 send status
     */
    public function sendEmail($emailTemplate, $parameters, $to, $from = null, $locale = null, $fromName = null, $cc = null, $bcc = null) {
        if (empty($locale)) {
            $locale = $this->container->get('bc.manager')->getRequest()->getLocale();
        }
        if (empty($fromName)) {
            $fromName = $this->container->getParameter('bc.conf.default.nombre.admin');
        }
        if (empty($from)) {
            $from = $this->container->getParameter('mailer_user');
        }

        $twig = $this->container->getParameter('bc.email.directory') . ':' . $locale . '/' . $emailTemplate . '.html.twig';
        $template = $this->twig->load($twig);

        $subject = $template->renderBlock('subject', $parameters);
        $bodyHtml = $template->renderBlock('body_html', $parameters);
        $bodyText = $template->renderBlock('body_text', $parameters);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from, $fromName)
            ->setTo($to)
            ->setCc($cc)
            ->setBcc($bcc)
            ->setBody($bodyHtml, 'text/html')
            ->addPart($bodyText, 'text/plain');

        return $this->mailer->send($message);
    }
}
