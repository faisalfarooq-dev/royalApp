<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\ApiRequestService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    protected ApiRequestService $apiRequest;

    public function __construct()
    {
        $this->apiRequest = new ApiRequestService();
    }

    /**
     * @param $book_id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function show($book_id): Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
    {
        try {
            $book = $this->apiRequest->getDetailApi('books/', $book_id);

            return view('book.show', compact('book'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param $book_id
     * @return RedirectResponse
     */
    public function delete($book_id): RedirectResponse
    {
        try {
            $this->apiRequest->deleteRecordApi('books/', $book_id);

            return redirect()->back()->with('success', 'Book deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function create(): Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
    {
        try {
            $authors = $this->apiRequest->getAuthorsApi('authors');
            return view('book.create', compact('authors'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * @param BookRequest $request
     * @return RedirectResponse
     */
    public function store(BookRequest $request): RedirectResponse
    {
        try {
            $data = $this->_setBookData($request);

            $this->apiRequest->postDataRequestApi('books', $data);

            return redirect()->back()->with('success', 'Book created successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function _setBookData($request)
    {
        return
            [
                'author' => [
                    'id' => $request->author
                ],
                'title' => $request->title,
                'release_date' => $request->release_date,
                'description' => $request->desc,
                'isbn' => $request->isbn,
                'format' => $request->book_format,
                'number_of_pages' => (int)$request->number_of_pages
            ];
    }
}
