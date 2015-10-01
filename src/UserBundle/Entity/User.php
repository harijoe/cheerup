<?php
namespace UserBundle\Entity;

use AppBundle\Entity\UserProfile;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="cheerup_user")
 */
class User extends BaseUser
{
    const NETWORK_VOLUNTEER = 'NETWORK_VOLUNTEER';
    const FORMER_MEMBER     = 'FORMER_MEMBER';

    private static $profileTypes = [
        self::NETWORK_VOLUNTEER => 'user.profile_type.network_volunteer',
        self::FORMER_MEMBER     => 'user.profile_type.former_member'
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getProfileTypes")
     */
    protected $profileType;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    protected $lastname;

    /**
     * @var UserProfile
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\UserProfile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_profile_id", referencedColumnName="id")
     */
    private $userProfile;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function __construct()
    {
        parent::__construct();
        $this->userProfile = new UserProfile();
    }

    public function getFullName()
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * @return string
     */
    public function getProfileType()
    {
        return $this->profileType;
    }

    /**
     * @param string $profileType
     */
    public function setProfileType($profileType)
    {
        $this->profileType = $profileType;
    }

    /**
     * @return array
     */
    public static function getProfileTypes()
    {
        return array_keys(self::$profileTypes);
    }

    /**
     * @return array
     */
    public static function getProfileTypesChoices()
    {
        return self::$profileTypes;
    }

    /**
     * @return UserProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }

    /**
     * @param UserProfile $userProfile
     */
    public function setUserProfile($userProfile)
    {
        $this->userProfile = $userProfile;
    }
}
