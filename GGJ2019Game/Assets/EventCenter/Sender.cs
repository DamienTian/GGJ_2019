using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Sender : MonoBehaviour {

	// Use this for initialization
	void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
        if (Input.GetKey(KeyCode.W))
        {
            EventCenter.Emit("up");
        }

        if (Input.GetKey(KeyCode.S))
        {
            EventCenter.Emit("down");
        }
    }
}
