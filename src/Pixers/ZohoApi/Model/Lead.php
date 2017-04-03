<?php

namespace Pixers\ZohoApi\Model;

/**
 * Lead Model
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
class Lead extends AbstractModel implements ModelInterface
{
    /**
     * @var string
     */
    protected $leadOwner;

    /**
     * @var string
     */
    protected $salutation;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $leadSource;

    /**
     * @var string
     */
    protected $industry;

    /**
     * @var integer
     */
    protected $annualRevenue;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $mobile;

    /**
     * @var string
     */
    protected $fax;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $secondaryEmail;

    /**
     * @var string
     */
    protected $skypeId;

    /**
     * @var string
     */
    protected $website;

    /**
     * @var string
     */
    protected $leadStatus;

    /**
     * @var string
     */
    protected $rating;

    /**
     * @var integer
     */
    protected $noOfEmployees;

    /**
     * @var string
     */
    protected $emailOptOut;

    /**
     * @var string
     */
    protected $campaignSource;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $zipCode;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $description;


    /**
     * @return string
     */
    public function getApiName()
    {
        return 'Leads';
    }

    /**
     * @return array
     */
    public function getFieldsForApiMapping()
    {
        return [
            'Lead Owner' => $this->leadOwner,
            'Salutation' => $this->salutation,
            'First Name' => $this->firstName,
            'Last Name' => $this->lastName,
            'Title' => $this->title,
            'Company' => $this->company,
            'Lead Source' => $this->leadSource,
            'Industry' => $this->industry,
            'Annual Revenue' => $this->annualRevenue,
            'Phone' => $this->phone,
            'Mobile' => $this->mobile,
            'Fax' => $this->fax,
            'Email' => $this->email,
            'Secondary Email' => $this->secondaryEmail,
            'Skype ID' => $this->skypeId,
            'Website' => $this->website,
            'Lead Status' => $this->leadStatus,
            'Rating' => $this->rating,
            'No of Employees' => $this->noOfEmployees,
            'Email Opt Out' => $this->emailOptOut,
            'Campaign Source' => $this->campaignSource,
            'Street' => $this->street,
            'City' => $this->city,
            'State' => $this->state,
            'Zip Code' => $this->zipCode,
            'Country' => $this->country,
            'Description' => $this->description,
        ];
    }
}
