<?php

namespace Respant\InvestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expense
 *
 * @ORM\Table(name="expense")
 * @ORM\Entity(repositoryClass="Respant\InvestBundle\Repository\ExpenseRepository")
 */
class Expense
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="expenses")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="interestRate", type="decimal", precision=5, scale=2)
     */
    private $interestRate;

    /**
     * @var bool
     *
     * @ORM\Column(name="closed", type="boolean")
     */
    private $closed;

    /**
     * @var string
     *
     * @ORM\Column(name="extraFee", type="decimal", precision=10, scale=2)
     */
    private $extraFee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return Expense
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set interestRate
     *
     * @param string $interestRate
     *
     * @return Expense
     */
    public function setInterestRate($interestRate)
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    /**
     * Get interestRate
     *
     * @return string
     */
    public function getInterestRate()
    {
        return $this->interestRate;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Expense
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set extraFee
     *
     * @param string $extraFee
     *
     * @return Expense
     */
    public function setExtraFee($extraFee)
    {
        $this->extraFee = $extraFee;

        return $this;
    }

    /**
     * Get extraFee
     *
     * @return string
     */
    public function getExtraFee()
    {
        return $this->extraFee;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Expense
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set company
     *
     * @param \Respant\InvestBundle\Entity\Company $company
     *
     * @return Expense
     */
    public function setCompany(\Respant\InvestBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Respant\InvestBundle\Entity\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Expense
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
