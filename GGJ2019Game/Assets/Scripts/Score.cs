using System.Collections;
using System.Collections.Generic;
using UnityEngine;

[CreateAssetMenu]
public class Score : ScriptableObject
{
    public float value;

    [System.NonSerialized]
    public float rvalue;
    public void OnAfterDeserialize()
    {
        rvalue = value;
    }
    public void OnBeforeSerialize() { }
}
