<?php


namespace App\Controller;

use App\Repository\PetRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PetController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class PetController
{

    private $petRepository;

    /**
     * PetController constructor.
     * @param $petRepository
     */
    public function __construct(PetRepository $petRepository)
    {
        $this->petRepository = $petRepository;
    }

    /**
     * @Route("pet", name="add_pet", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $category = $data['category'];
        $name = $data['name'];
        $photoUrls = $data['photoUrls'];
        $tags = $data['tags'];
        $status = $data['status'];

        if (empty($name) || empty($status)) {
            throw new NotFoundHttpException("Expecting other items");
        }

        $this->petRepository->savePet($name, $category, $photoUrls, $tags, $status);

        return new JsonResponse(['STATUS' => 'Pet Created'], Response::HTTP_CREATED);


    }

    /**
     * @Route("pets", name="get_all_pets", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        $pets = $this->petRepository->findAll();
        $data = [];

        foreach ($pets as $pet) {
            $data[] = [
                'id' => $pet->getId(),
                'name' => $pet -> getName(),
                'category' => $pet -> getCategory(),
                'photoUrls' => $pet -> getPhotoUrl(),
                'tags' => $pet -> getTags(),
                'status' => $pet -> getStatus(),

            ];
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("pet/{id}", name="get_one_pet", methods={GET})
     * @param $id
     * @return JsonResponse
     */
    public function get($id): JsonResponse
    {
        $pet = $this->petRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $pet->getId(),
            'name' => $pet -> getName(),
            'category' => $pet -> getCategory(),
            'photoUrls' => $pet -> getPhotoUrl(),
            'tags' => $pet -> getTags(),
            'status' => $pet -> getStatus(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("pet/{id}", name="update_pet", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $pet = $this->petRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['name']) ? true : $pet->setName($data['name']);
        empty($data['category']) ? true : $pet->setCategory($data['category']);
        empty($data['photoUrls']) ? true : $pet->setPhotoUrl($data['photoUrls']);
        empty($data['tags']) ? true : $pet->setTags($data['tags']);
        empty($data['status']) ? true : $pet->setStatus($data['status']);

         $this->petRepository->updatePet($pet);

        return new JsonResponse(['status' => 'Pet updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("pet/{id}", name="delete_pet, methods={"DELETE"}")
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $pet = $this->petRepository->findOneBy(['id' => $id]);

        $this->petRepository->removePet($pet);

        return new JsonResponse(['status' => 'pet deleted'], Response::HTTP_OK);
    }

}