using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class EventCenter : MonoBehaviour {


    //zero argument events
    public delegate void ZeroArgEvent();

    //private Dictionary<string, ZeroArgEvent> zeroArgEvts;
    private static Dictionary<string, ZeroArgEvent> zeroArgEvts = new Dictionary<string, ZeroArgEvent>();
    public static void Emit(string evtName)
    {
        ZeroArgEvent evt;
        if (zeroArgEvts.TryGetValue(evtName, out evt))
        {
            if (evt != null)
            {
                evt();
            }
        }

    }

    public static void On(string evtName, ZeroArgEvent func)
    {
        ZeroArgEvent evt;
        if (zeroArgEvts.TryGetValue(evtName, out evt))
        {
            zeroArgEvts[evtName] += func;
            Debug.Log("add");
        }
        else
        {
            zeroArgEvts.Add(evtName, func);
            Debug.Log("create");
        }
    }

    public static void Off(string evtName, ZeroArgEvent func)
    {
        ZeroArgEvent evt;
        if (zeroArgEvts.TryGetValue(evtName, out evt))
        {
            zeroArgEvts[evtName] -= func;
            Debug.Log("destroy");
        }
    }

}
