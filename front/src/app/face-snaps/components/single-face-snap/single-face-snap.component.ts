import { Component, OnInit } from '@angular/core';
import { FaceSnap } from '../../../core/models/face-snap.model';
import { FaceSnapsService } from '../../../core/services/face-snaps.service';
import { ActivatedRoute } from '@angular/router';
import {Observable} from "rxjs";
import {tap} from "rxjs/operators";
import {FormBuilder, FormControl, FormGroup, NgForm, Validators} from "@angular/forms";
import {NotificationService} from "../../../core/services/notification.service";
import Pusher from "pusher-js";
import {FroalaEditorModule} from "angular-froala-wysiwyg";

@Component({
  selector: 'app-single-face-snap',
  templateUrl: './single-face-snap.component.html',
  styleUrls: ['./single-face-snap.component.scss']
})
export class SingleFaceSnapComponent implements OnInit {
  faceSnap!: FaceSnap;
  faceSnap$!: Observable<FaceSnap>;
  snapForm!: FormGroup;

  buttonText!: string;
  entierRegex!: RegExp;
  channel!:any;
  info!: string;
  lesLikes$!: Observable<any>;


  constructor(private faceSnapsService: FaceSnapsService,
              private route: ActivatedRoute,
              private  formBuilder: FormBuilder,
              private pusherS:NotificationService) {}

  ngOnInit() {
    this.buttonText = 'Oh Snap!';
    const faceSnapId = +this.route.snapshot.params['id'];
    // this.faceSnap = this.faceSnapsService.getFaceSnapById(faceSnapId);
     this.faceSnap$ = this.faceSnapsService.getFaceSnapById(faceSnapId);
    this.buttonText = 'aimer!';

    // // // //@todo logique a remplacer par snapFacesnapService
    // this.entierRegex = /^\d+$/;
    // this.snapForm = this.formBuilder.group({
    //     like: [null, Validators.required],
    //     lId: [null, Validators.required]
    //   }, {
    //     updateOn: 'blur' // formulaire mis a jours lorsqu'on change de champs
    //   }
    // );

  }


  /**
   * likons ce truc
   */

  onSendReact(faceSnapId: string,like:string){


    const formData : FormData = new FormData();
    formData.append('like',like.toString())
    formData.append('lId',faceSnapId.toString())

    this.faceSnapsService.reaction(formData).subscribe(
      (res=>{
       // console.log(res)
      })
    );


    if (this.buttonText === 'aimer!') {
      this.buttonText = 'deja aimer!';
    }
  }


}
