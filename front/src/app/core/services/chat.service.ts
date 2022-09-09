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
export class chatService {
  constructor(private http: HttpClient,
              private auth: AuthService,
              private toastr: ToastrService) {
  }


  getAllMessage(): Observable<any> {
    // return this.http.get<FaceSnap[]>('http://localhost:9000/index.php?action=postsApi')
    return this.http.get<FaceSnap[]>('http://localhost:9000/messages')
  }

  getPusherMessage(): Observable<any> {
    // return this.http.get<FaceSnap[]>('http://localhost:9000/index.php?action=postsApi')
    return this.http.get<FaceSnap[]>('http://localhost:9000/pusherMessage')
  }

  addMessage(formData:FormData):Observable<any>{
    return this.http.post<any>('http://localhost:9000/addMessage',formData)
  }
}
