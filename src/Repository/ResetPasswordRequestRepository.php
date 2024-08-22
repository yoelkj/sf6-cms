<?php

namespace App\Repository;

use App\Entity\Agency;
use App\Entity\ResetPasswordAgencyRequest;
use App\Entity\ResetPasswordRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Persistence\Repository\ResetPasswordRequestRepositoryTrait;
use SymfonyCasts\Bundle\ResetPassword\Persistence\ResetPasswordRequestRepositoryInterface;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @extends ServiceEntityRepository<ResetPasswordRequest>
 *
 * @method ResetPasswordRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResetPasswordRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResetPasswordRequest[]    findAll()
 * @method ResetPasswordRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetPasswordRequestRepository extends ServiceEntityRepository implements ResetPasswordRequestRepositoryInterface
{
    use ResetPasswordRequestRepositoryTrait;

    private Session $session;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResetPasswordRequest::class);

        $this->session = new Session();
    }

    public function save(ResetPasswordRequest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ResetPasswordRequest $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function createResetPasswordRequest(object $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken): ResetPasswordRequestInterface
    {

        return new ResetPasswordRequest($user, $expiresAt, $selector, $hashedToken);

        //return new ResetPasswordRequest($user, $expiresAt, $selector, $hashedToken);
    }

    public function getMostRecentNonExpiredRequestDate(object $user): ?\DateTimeInterface
    {

        $resetPasswordRequest = $this->createQueryBuilder('t')
            ->where('t.user = :user')
            ->setParameter('user', $user)
            ->orderBy('t.requestedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneorNullResult();

        if (null !== $resetPasswordRequest && !$resetPasswordRequest->isExpired()) {
            return $resetPasswordRequest->getRequestedAt();
        }

        return null;
    }

    public function removeResetPasswordRequest(ResetPasswordRequestInterface $resetPasswordRequest): void
    {

        $user  = $resetPasswordRequest->getUser();

        $this->createQueryBuilder('t')
            ->delete()
            ->where('t.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute()
        ;
    }

    public function removeExpiredResetPasswordRequests(): int
    {
        $time = new \DateTimeImmutable('-1 week');

        $query = $this->createQueryBuilder('t')
            ->delete()
            ->where('t.expiresAt <= :time')
            ->setParameter('time', $time)
            ->getQuery();
        return $query->execute();
    }

    public function findResetPasswordRequest(string $selector): ?ResetPasswordRequestInterface
    {
        $result_object = $this->findOneBy(['selector' => $selector]);
        return $result_object;
    }
}
