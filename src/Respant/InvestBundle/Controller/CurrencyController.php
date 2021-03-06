<?php

namespace Respant\InvestBundle\Controller;

use Respant\InvestBundle\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Currency controller.
 *
 * @Route("currency")
 */
class CurrencyController extends Controller
{
    /**
     * Lists all currency entities.
     *
     * @Route("/", name="currency_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $currencies = $em->getRepository('RespantInvestBundle:Currency')->findAll();

        return $this->render('RespantInvestBundle:Currency:index.html.twig', array(
            'currencies' => $currencies,
        ));
    }

    /**
     * Creates a new currency entity.
     *
     * @Route("/new", name="currency_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $currency = new Currency();
        $form = $this->createForm('Respant\InvestBundle\Form\CurrencyType', $currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($currency);
            $em->flush($currency);

            return $this->redirectToRoute('currency_index');
        }

        return $this->render('RespantInvestBundle:Currency:new.html.twig', array(
            'currency' => $currency,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a currency entity.
     *
     * @Route("/{id}", name="currency_show")
     * @Method("GET")
     */
    public function showAction(Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);

        return $this->render('RespantInvestBundle:Currency:show.html.twig', array(
            'currency' => $currency,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing currency entity.
     *
     * @Route("/{id}/edit", name="currency_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Currency $currency)
    {
        $deleteForm = $this->createDeleteForm($currency);
        $editForm = $this->createForm('Respant\InvestBundle\Form\CurrencyType', $currency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('currency_index');
        }

        return $this->render('RespantInvestBundle:Currency:edit.html.twig', array(
            'currency' => $currency,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a currency entity.
     *
     * @Route("/{id}", name="currency_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Currency $currency)
    {
        $form = $this->createDeleteForm($currency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($currency);
            $em->flush($currency);
        }

        return $this->redirectToRoute('currency_index');
    }

    /**
     * Creates a form to delete a currency entity.
     *
     * @param Currency $currency The currency entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Currency $currency)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('currency_delete', array('id' => $currency->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
