<?php

namespace Respant\InvestBundle\Controller;

use Respant\InvestBundle\Entity\Expense;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Expense controller.
 *
 * @Route("expense")
 */
class ExpenseController extends Controller
{
    /**
     * Lists all expense entities.
     *
     * @Route("/", name="expense_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $expenses = $em->getRepository('RespantInvestBundle:Expense')->findAll();

        return $this->render('RespantInvestBundle:Expense:index.html.twig', array(
            'expenses' => $expenses,
        ));
    }

    /**
     * Creates a new expense entity.
     *
     * @Route("/new", name="expense_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $expense = new Expense();
        $form = $this->createForm('Respant\InvestBundle\Form\ExpenseType', $expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expense);
            $em->flush($expense);

            return $this->redirectToRoute('expense_index');
        }

        return $this->render('RespantInvestBundle:Expense:new.html.twig', array(
            'expense' => $expense,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a expense entity.
     *
     * @Route("/{id}", name="expense_show")
     * @Method("GET")
     */
    public function showAction(Expense $expense)
    {
        $deleteForm = $this->createDeleteForm($expense);

        return $this->render('RespantInvestBundle:Expense:show.html.twig', array(
            'expense' => $expense,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing expense entity.
     *
     * @Route("/{id}/edit", name="expense_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Expense $expense)
    {
        $deleteForm = $this->createDeleteForm($expense);
        $editForm = $this->createForm('Respant\InvestBundle\Form\ExpenseType', $expense);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expense_index');
        }

        return $this->render('RespantInvestBundle:Expense:edit.html.twig', array(
            'expense' => $expense,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a expense entity.
     *
     * @Route("/{id}", name="expense_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Expense $expense)
    {
        $form = $this->createDeleteForm($expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expense);
            $em->flush($expense);
        }

        return $this->redirectToRoute('expense_index');
    }

    /**
     * Creates a form to delete a expense entity.
     *
     * @param Expense $expense The expense entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Expense $expense)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expense_delete', array('id' => $expense->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
