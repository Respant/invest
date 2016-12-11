<?php

namespace Respant\InvestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Income
 *
 * @ORM\Table(name="income")
 * @ORM\Entity(repositoryClass="Respant\InvestBundle\Repository\IncomeRepository")
 */
class Income
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
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="incomes")
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
     * @return Income
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
     * Set extraFee
     *
     * @param string $extraFee
     *
     * @return Income
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
     * @return Income
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
     * @return Income
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
}
