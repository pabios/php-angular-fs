import { Injectable } from '@angular/core';
import { FaceSnap } from '../models/face-snap.model';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {environment} from "../../../environments/environment";
import {filter, map, switchMap, tap} from "rxjs/operators";
import {AuthService} from "./auth.service";
import {ToastrService} from "ngx-toastr";

@Injectable({
  providedIn: 'root'
})
export class FaceSnapsService {
  constructor(private http: HttpClient,
              private auth: AuthService,
              private toastr: ToastrService) {
  }



  //faceSnaps: FaceSnap[] = [];

  /*getAllFaceSnaps(): FaceSnap[] {
    return this.faceSnaps;
  }*/
  getAllFaceSnaps(): Observable<FaceSnap[]> {
    // return this.http.get<FaceSnap[]>('http://localhost:9000/index.php?action=postsApi')
    return this.http.get<FaceSnap[]>('http://localhost:9000/posts')
  }


  getFaceSnapById(faceSnapId: number): Observable<FaceSnap> {
    //http://localhost:9000/index.php?action=unPost&id=1
   // return this.http.get<FaceSnap>(`http://localhost:3000/facesnaps/${faceSnapId}`)
    return this.http.get<FaceSnap>(`http://localhost:9000/post/${faceSnapId}`)
  }


  like!:number;
  lId!:number;
  snapFaceSnapById(faceSnapId: number, snapType: 'snap' | 'unsnap'): Observable<FaceSnap> {

    return this.getFaceSnapById(faceSnapId).pipe(
      map(faceSnap => ({
        snaps: faceSnap.snaps + (snapType === 'snap' ? 1 : -1),
        id: faceSnapId,
      })),

      switchMap(updatedFaceSnap => this.http.post<any>(
        `http://localhost:9000/react`,
        updatedFaceSnap)
      )

    );
  }



  addFaceSnap(formValue: { title: string, description: string, imageUrl: string, location?: string }): Observable<FaceSnap> {
    return this.getAllFaceSnaps().pipe(
      map(facesnaps => [...facesnaps].sort((a,b) => a.id - b.id)),
      map(sortedFacesnaps => sortedFacesnaps[sortedFacesnaps.length - 1]),
      map(previousFacesnap => ({
        ...formValue,
        snaps: 0,
        createdDate: new Date(),
        id: previousFacesnap.id + 1
      })),
      switchMap(newFacesnap => this.http.post<FaceSnap>(
        'http://localhost:9000/add ',
        newFacesnap)
      )// http://localhost:3000/facesnaps
    );
  }

  /**
   * nouveau enregistrement
   * @param formData
   */
  ajout(formData:FormData):Observable<any>{
    // return this.http.post<any>('http://localhost:9000/index.php?action=addPostApi',formData)
    return this.http.post<any>('http://localhost:9000/add',formData)
  }

  reaction(formData:FormData):Observable<any>{
    // return this.http.post<any>('http://localhost:9000/index.php?action=reaction',
    return this.http.post<any>('http://localhost:9000/react',
      formData)
  }



  nbPost():Observable<any> {
    // return this.http.get<any>("http://localhost:9000/index.php?action=nbPostApi");
    return this.http.get<any>("http://localhost:9000/countPost");
  }
  troisDernier():Observable<any>{
    return this.http.get<any>("http://localhost:9000/troisDernier");
  }



}
