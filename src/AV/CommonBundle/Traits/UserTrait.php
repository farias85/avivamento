<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 10/10/2018
 * Time: 11:57
 */

namespace AV\CommonBundle\Traits;


trait UserTrait {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=false)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="verification_key", type="string", length=100, nullable=true)
     */
    protected $verificationKey;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="plain_password", type="text", nullable=false)
     */
    protected $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="text", nullable=true)
     */
    protected $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="latest_connection", type="datetime", nullable=true)
     */
    protected $latestConnection;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    protected $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_confirm", type="boolean", nullable=false)
     */
    protected $isConfirm;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=100, nullable=false)
     */
    protected $ref;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roles_json", type="text", length=65535, nullable=true)
     */
    protected $rolesJson;

    /**
     * @var array
     */
    protected $roles;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param integer $email
     *
     * @return object
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return integer
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return object
     */
    public function setName($nombre) {
        $this->name = $nombre;
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return object
     */
    public function setLastname($apellidos) {
        $this->lastname = $apellidos;
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set telefono
     *
     * @param string $phone
     *
     * @return object
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set isConfirm
     *
     * @param boolean $isConfirm
     *
     * @return object
     */
    public function setIsConfirm($isConfirm) {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    public function isConfirm() {
        return $this->getIsConfirm();
    }

    /**
     * Get isConfirm
     *
     * @return boolean
     */
    public function getIsConfirm() {
        return $this->isConfirm;
    }

    /**
     * @return string
     */
    public function getRef() {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef(string $ref) {
        $this->ref = $ref;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return object
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    public function isActive() {
        return $this->getIsActive();
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    /**
     * Set password
     *
     * @param boolean $password
     *
     * @return object
     */
    public function setPlainPassword($password) {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationKey() {
        return $this->verificationKey;
    }

    /**
     * @param string $verificationKey
     *
     * @return object
     */
    public function setVerificationKey($verificationKey) {
        $this->verificationKey = $verificationKey;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLatestConnection() {
        return $this->latestConnection;
    }

    /**
     * @param \DateTime $latestConnection
     *
     * @return object
     */
    public function setLatestConnection($latestConnection) {
        $this->latestConnection = $latestConnection;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRolesJson() {
        return $this->rolesJson;
    }

    /**
     * @param null|string $rolesJson
     */
    public function setRolesJson($rolesJson) {
        $this->rolesJson = $rolesJson;
    }

    public function addRole($role) {
        $role = strtoupper($role);

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * Returns the user roles
     * @see AdvancedUserInterface::getRoles()
     * @return array The roles
     */
    public function getRoles() {
        $this->roles = [static::ROLE_DEFAULT];
        return array_unique($this->roles);
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return object
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     * @see AdvancedUserInterface::getPassword()
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return object
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     * @see AdvancedUserInterface::getSalt()
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @see AdvancedUserInterface::getUsername()
     * @return string
     */
    public function getUsername() {
        return $this->getEmail();
    }

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials() {
    }

    /**
     * @see AdvancedUserInterface::isAccountNonExpired()
     * @return bool
     */
    public function isAccountNonExpired() {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isAccountNonLocked()
     * @return bool
     */
    public function isAccountNonLocked() {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isCredentialsNonExpired()
     * @return bool
     */
    public function isCredentialsNonExpired() {
        return true;
    }

    /**
     * @see AdvancedUserInterface::isEnabled()
     * @return bool
     */
    public function isEnabled() {
        return $this->isActive();
    }

    /**
     * @see \Serializable::serialize()
     * @return string
     */
    public function serialize() {
        return serialize(array(
            $this->getId(),
            $this->getEmail(),
            $this->getPassword(),
            $this->isActive(),
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     * @param $serialized
     */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}