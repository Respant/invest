<?php

namespace Respant\InvestBundle\Controller;

use Respant\InvestBundle\Entity\Income;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Income controller.
 *
 * @Route("income")
 */
class IncomeController extends Controller
{
    /**
     * Lists all income entities.
     *
     * @Route("/", name="income_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $incomes = $em->getRepository('RespantInvestBundle:Income')->findAll();

        return $this->render('RespantInvestBundle:Income:index.html.twig', array(
            'incomes' => $incomes,
        ));
    }

    /**
     * Creates a new income entity.
     *
     * @Route("/new", name="income_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $income = new Income();
        $form = $this->createForm('Respant\InvestBundle\Form\IncomeType', $income);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($income);
            $em->flush($income);

            return $this->redirectToRoute('income_index');
        }

        return $this->render('RespantInvestBundle:Income:new.html.twig', array(
            'income' => $income,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a income entity.
     *
     * @Route("/{id}", name="income_show")
     * @Method("GET")
     */
    public function showAction(Income $income)
    {
        $deleteForm = $this->createDeleteForm($income);

        return $this->render('RespantInvestBundle:Income:show.html.twig', array(
            'income' => $income,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing income entity.
     *
     * @Route("/{id}/edit", name="income_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Income $income)
    {
        $deleteForm = $this->createDeleteForm($income);
        $editForm = $this->createForm('Respant\InvestBundle\Form\IncomeType', $income);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('income_index');
        }

        return $this->render('RespantInvestBundle:Income:edit.html.twig', array(
            'income' => $income,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a income entity.
     *
     * @Route("/{id}", name="income_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Income $income)
    {
        $form = $this->createDeleteForm($income);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($income);
            $em->flush($income);
        }

        return $this->redirectToRoute('income_index');
    }

    /**
     * Creates a form to delete a income entity.
     *
     * @param Income $income The income entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Income $income)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('income_delete', array('id' => $income->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
