<?php

namespace App\Http\Controllers;

use App\Warship;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
class ApiWarshipsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/warships",
     *      operationId="getWarshipsList",
     *      tags={"Warships"},
     *      summary="Get list of warships",
     *      description="Returns list of warships",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Returns list of warships
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warships = Warship::all();
        return $warships;
    }

    /**
     * @OA\Post(
     *      path="/api/warships",
     *      operationId="postWarship",
     *      tags={"Warships"},
     *      summary="Store warship information",
     *      description="Returns warship data",
     *      @OA\Parameter(
     *          name="name",
     *          description="Warship name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="class",
     *          description="Warship class",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="built",
     *          description="Warship built",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lenght",
     *          description="Warship lenght",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="heigth",
     *          description="Warship heigth",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="power",
     *          description="Warship power",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="speed",
     *          description="Warship speed",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:warships", "read:warships"}
     *         }
     *     },
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warship = new Warship;

        $warship->name = $request->name;
        $warship->class = $request->class;
        $warship->built = $request->built;
        $warship->length = $request->length;
        $warship->height = $request->height;
        $warship->power = $request->power;
        $warship->speed = $request->speed;

        $warship->save();

        return $warship;
    }

    /**
     * @OA\Get(
     *      path="/api/warships/{id}",
     *      operationId="getWarshipById",
     *      tags={"Warships"},
     *      summary="Get warship information",
     *      description="Returns warship data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Warship id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:warships", "read:warships"}
     *         }
     *     },
     * )
     *
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warship = Warship::find($id);
        return $warship;
    }

    /**
     * @OA\Put(
     *      path="/api/warships/{id}",
     *      operationId="putWarshipById",
     *      tags={"Warships"},
     *      summary="Update warship information",
     *      description="Returns warship data",
     *      @OA\Parameter(
     *          name="name",
     *          description="Warship name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="class",
     *          description="Warship class",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="built",
     *          description="Warship built",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lenght",
     *          description="Warship lenght",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )     *      ),
     *      @OA\Parameter(
     *          name="heigth",
     *          description="Warship heigth",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="power",
     *          description="Warship power",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="speed",
     *          description="Warship speed",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:warships", "read:warships"}
     *         }
     *     },
     * )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $warship = Warship::find($id);

        $warship->name = $request->name;
        $warship->class = $request->class;
        $warship->built = $request->built;
        $warship->length = $request->length;
        $warship->height = $request->height;
        $warship->power = $request->power;
        $warship->speed = $request->speed;

        $warship->save();

        return $warship;
    }

    /**
     * @OA\Delete(
     *      path="/api/warships/{id}",
     *      operationId="deleteWarshipById",
     *      tags={"Warships"},
     *      summary="Delete warship",
     *      description="Returns warship list",
     *      @OA\Parameter(
     *          name="id",
     *          description="Warship id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:warships", "read:warships"}
     *         }
     *     },
     * )
     *
     * Remove the specified resource.
     *
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warship = Warship::destroy($id);

        $warships = Warship::all();
        return $warships;
    }
}
