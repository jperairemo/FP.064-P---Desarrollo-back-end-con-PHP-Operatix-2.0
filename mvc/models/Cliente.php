<?php
// Clase Cliente: representa un viajero del sistema
class Cliente {

    private $id_viajero;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $direccion;
    private $codigoPostal;
    private $ciudad;
    private $pais;
    private $email;
    private $password;

    public function __construct($id_viajero, $nombre, $apellido1, $apellido2, $direccion,
                                $codigoPostal, $ciudad, $pais, $email, $password) {

        $this->id_viajero = $id_viajero;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->direccion = $direccion;
        $this->codigoPostal = $codigoPostal;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->email = $email;
        $this->password = $password;
    }

    // Getters
    public function getIdViajero() { return $this->id_viajero; }
    public function getNombre() { return $this->nombre; }
    public function getApellido1() { return $this->apellido1; }
    public function getApellido2() { return $this->apellido2; }
    public function getDireccion() { return $this->direccion; }
    public function getCodigoPostal() { return $this->codigoPostal; }
    public function getCiudad() { return $this->ciudad; }
    public function getPais() { return $this->pais; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }

    // Setters
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setApellido1($apellido1) { $this->apellido1 = $apellido1; }
    public function setApellido2($apellido2) { $this->apellido2 = $apellido2; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setCodigoPostal($codigoPostal) { $this->codigoPostal = $codigoPostal; }
    public function setCiudad($ciudad) { $this->ciudad = $ciudad; }
    public function setPais($pais) { $this->pais = $pais; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
}
?>
