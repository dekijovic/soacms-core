<?php

namespace Modules\EcommerceBundle\Entity;

use CmsBundle\Entity\WebUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="ec_invoices")
 * @ORM\Entity(repositoryClass="Modules\EcommerceBundle\Repository\EcommerceInvoiceRepository")
 */
class EcommerceInvoice
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
     * @var
     * @ORM\Column(name="invoice_number", type="string")
     */
    private $invoiceNumber;

    /**
     * @var WebUser
     * @ORM\ManyToOne(targetEntity="CmsBundle\Entity\WebUser")
     */
    private $customer;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param mixed $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return WebUser
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param WebUser $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }


}
