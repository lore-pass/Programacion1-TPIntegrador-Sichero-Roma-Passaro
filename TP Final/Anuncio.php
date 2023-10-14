<?php 

class Anuncio
{
    public $id;
    public $titulo;
    public $texto;
    public $fecha_publicacion;
    public $vigente = true;
    public $usuarios_id;

    public function __construct(
        $titulo, $texto, $fecha_publicacion, $usuarios_id, Array $comisiones, $id = null
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->usuarios_id = $usuarios_id;
    }

    public function setVigencia($vigencia)
    {
        $this->vigente = $vigencia;        
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}
