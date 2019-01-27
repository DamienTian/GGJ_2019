using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Receiver : MonoBehaviour {

    private void OnEnable()
    {
        EventCenter.On("up", MoveUp);
        EventCenter.On("down", MoveDown);
    }

    private void OnDisable()
    {
        EventCenter.Off("up", MoveUp);
        EventCenter.Off("down", MoveDown);
    }

    private void MoveUp()
    {
        transform.position += new Vector3(0,1,0);
    }

    private void MoveDown()
    {
        transform.position += new Vector3(0, -1, 0);
    }
}
