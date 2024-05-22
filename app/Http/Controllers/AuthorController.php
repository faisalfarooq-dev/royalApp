<?php

namespace App\Http\Controllers;

use App\Services\ApiRequestService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthorController extends Controller
{
    protected ApiRequestService $apiRequestService;

    public function __construct()
    {
        $this->apiRequestService = new ApiRequestService();
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
    {
        try {
            $authors = $this->apiRequestService->getAuthorsApi('authors?orderBy=id');
            return view('author.index', compact('authors'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $author_id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function show($author_id): Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
    {
        try {
            $author = $this->apiRequestService->getDetailApi('authors/', $author_id);
            return view('author.show', compact('author'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $author_id
     * @return RedirectResponse
     */
    public function delete($author_id): RedirectResponse
    {
        try {
            $this->apiRequestService->deleteRecordApi('authors/', $author_id);

            return redirect()->route('author.index')->with('success', 'Deleted successfully.');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        return redirect()->to('/')->with('success', 'Logout successfully');
    }
}
