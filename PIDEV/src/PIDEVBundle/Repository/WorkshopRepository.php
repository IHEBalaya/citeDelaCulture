<?php

namespace PIDEVBundle\Repository;

/**
 * WorkshopRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class WorkshopRepository extends \Doctrine\ORM\EntityRepository
{

    public function SelectWorkshopByidUSer($iduser)
{
    $etatworkshop="en cours";

    $query = $this->createQueryBuilder('f')
        // ->Where('f.idUser=:iduser')
        ->Where('f.etatWork=:etatworkshop')
        ->andWhere('f.idUser=:iduser')

        ->setParameter(':etatworkshop',$etatworkshop)
        ->setParameter(':iduser',$iduser);
    return $query->getQuery()->getResult();
}
    public function SelectWorkshopByidSession($idSession)
    {
        $etatworkshop="en cours";
        $query = $this->createQueryBuilder('s')
            ->Where('s.etatWork = :etatWork')
            ->andWhere('s.idSession=:idSession')
            ->setParameter(':idSession',$idSession)
            ->setParameter(':etatWork',$etatworkshop);
        return $query->getQuery()->getResult();
    }
    public function findByDateDql($date){
        $etatworkshop="en cours";
        $query = $this->createQueryBuilder('s')
            ->Where('s.etatWork = :etatWork')
            ->andWhere('s.date>:date')
            ->setParameter(':date',$date)
            ->setParameter(':etatWork',$etatworkshop);
        return $query->getQuery()->getResult();
    }
    public function findByDatearchive($date){
        $etatworkshop="en cours";
        $query = $this->createQueryBuilder('s')
            ->Where('s.etatWork = :etatWork')
            ->andWhere('s.date<:date')
            ->setParameter(':date',$date)
            ->setParameter(':etatWork',$etatworkshop);
        return $query->getQuery()->getResult();
    }
    public function findAnnonce2($search)
    {
        return $this->createQueryBuilder('e')
            ->where('UPPER(e.nom) LIKE UPPER(:search)')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();

    }
}
