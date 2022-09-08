import { Component, OnInit } from '@angular/core';
import { FaceSnap } from '../../../core/models/face-snap.model';
import { FaceSnapsService } from '../../../core/services/face-snaps.service';
import {Observable} from "rxjs";
import {ToastrService} from "ngx-toastr";
import {NotificationService} from "../../../core/services/notification.service";
import Pusher from "pusher-js";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Router} from "@angular/router";
import {AuthService} from "../../../core/services/auth.service";

@Component({
  selector: 'app-face-snap-list',
  templateUrl: './face-snap-list.component.html',
  styleUrls: ['./face-snap-list.component.scss']
})
export class FaceSnapListComponent implements OnInit {

  faceSnaps!: FaceSnap[];
  faceSnaps$!: Observable<FaceSnap[]>
  troisLast$!: Observable<any>;
  channel!:any;
  info!: string;




  constructor(private faceSnapsService: FaceSnapsService,
              private notif:NotificationService,
              private  formBuilder: FormBuilder,
              private router:Router,
              private auth:AuthService) {

  }

  ngOnInit(): void {
    //this.faceSnaps = this.faceSnapsService.getAllFaceSnaps();
    this.faceSnaps$ = this.faceSnapsService.getAllFaceSnaps();
    this.troisLast$ = this.faceSnapsService.troisDernier();

    Pusher.logToConsole = true;

    var pusher = new Pusher('2e4bc757da112b198aaf', {
      cluster: 'eu'
    });

     this.channel = pusher.subscribe('pabiosoft');
    this.channel.bind('my-event',  (data:string) => {
      // alert(JSON.stringify(data));
      alert(data);
      console.log(data);
      this.info = data;
    });

    console.log(this.auth.userId);console.log('********** dasn list posts')
  }

  goChat():void{
    this.router.navigateByUrl('/channel/chat').then(r => '');
  }




}
